<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JWTUtil {    private static $secretKey = sdaasd; 
    private static $issuer = 'http://your-issuer.com'; 
    private static $audience = 'http://your-audience.com';

    public static function createJWT($data) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour

        $payload = [
            'iat' => $issuedAt, // Issued at
            'exp' => $expirationTime, // Expiration time
            'iss' => self::$issuer, // Issuer
            'aud' => self::$audience, // Audience
            'data' => $data // Your custom data
        ];

        return JWT::encode($payload, self::$secretKey);
    }

    public static function verifyJWT($jwt) {
        try {
            $decoded = JWT::decode($jwt, self::$secretKey, ['HS256']);
            return (array) $decoded->data; // Return the custom data from the token
        } catch (ExpiredException $e) {
            echo 'Token has expired: ' . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo 'Token is invalid: ' . $e->getMessage();
            return null;
        }
    }
}
?>