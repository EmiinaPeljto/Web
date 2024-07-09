<?php

/**
 * @OA\Info(
 *   title="API",
 *   description="IMS API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="emina.peljto@stu.ibu.edu.ba",
 *     name="Emina Peljto"
 *   )
 * ),
 * @OA\OpenApi(
 *   @OA\Server(
 *       url=BASE_URL
 *   )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */
