<?php

declare(strict_types=1);
namespace App\Application\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\ActionBase;
use App\Application\Traits\Common;
use App\Application\Traits\Validation;
use App\Application\Traits\AppMailer;
use App\Application\Constants\Msg;
use App\Application\Constants\CS;
use Firebase\JWT\JWT;

class AuthAction extends ActionBase {

   use Common;
   use Validation;
   use AppMailer;

   function index($req, $res, $args): Response {
      $this->init($req, $res);
      $this->setBody();
      $method = self::es($args['name']);
      return $this->$method();
   }

   private function login(): Response {
      [ $email, $password ] = self::getLoginBody($this->b);
      $row = $this->getRow($email);
      self::verifyPassword($row, $password);
      return $this->json(self::getCredentials($row));
   }

   private function register(): Response {
      $d = self::getRegisterBody($this->b);
      $row = $this->getRow($d['email']);
      if($row) self::fire(Msg::USER_EXIST);
      $this->db->insert('users', $d);
      return $this->htm(Msg::SUCCESS);
   }

   private function recover(): Response {
      [ $email, $pin ] = self::getRecoverBody($this->b);
      $row = $this->getRow($email);
      self::verifyPin($row, $pin);
      $password = self::randomString();
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $where = ['email' => $email];
      $this->db->update('users', ['password' => $hash], $where);
      self::send([$email], 'Pin', $password);
      return $this->htm(Msg::PASSWORD_EMAILED);
   }

   private function pin(): Response {
      $email = self::getPinBody($this->b);
      $row = $this->getRow($email);
      self::verifyUser($row);
      $pin = self::randomString();
      self::send([$email], 'Pin', $pin);
      return $this->htm(Msg::PIN_EMAILED);
   }

   function getRow($email): array|null {
      $where = ['email' => $email];
      return $this->db->get('users', '*', $where);
   }

   static function verifyPassword($row, $password): void {
      self::verifyUser($row);
      $match = password_verify($password, $row['password']);
      if(! $match) self::fire(Msg::INVALID_PASSWORD);
   }

   static function verifyPin($row, $pin): void {
      self::verifyUser($row);
      $match = $pin == $row['pin'];
      if(! $match) self::fire(Msg::INVALID_PIN);
   }

   static function getCredentials($row): array {
      $account = [];
      foreach(['id', 'email', 'role', 'avatar', 'firstname', 'lastname'] as $key){
         $account[$key] = $row[$key]; }
      $token = JWT::encode($account, CS::APP_KEY, CS::RSA);
      return ['account' => $account, 'token' => $token];
   }

   static function getLoginBody(array $b): array {
      self::isValid($b, [
         'required' => ['email','password'], 'email' => ['email'],
         'lengthBetween' => [['password', 8, 16]]]);
      return [$b['email'], $b['password']];
   }

   static function getRegisterBody(array $b): array {
      self::isValid($b, [
         'required' => ['firstname', 'lastname', 'email', 'password'],
         'email' => ['email'], 'lengthBetween' => [['password', 8, 16]]]);
      return [
         'firstname' => self::xs($b['firstname']),
         'lastname' => self::xs($b['lastname']),
         'email' => strtolower($b['email']),
         'role' => 1,
         'password' => password_hash($b['password'], PASSWORD_DEFAULT)];
   }

   static function getRecoverBody(array $b): array {
      self::isValid($b, [
         'required' => ['email','pin'], 'email' => ['email'],
         'lengthBetween' => [['pin', 8, 16]]]);
      return [$b['email'], $b['pin']];
   }

   static function getPinBody(array $b): string {
      self::isValid($b, ['required' => ['email'], 'email' => ['email']]);
      return $b['email'];
   }
}
