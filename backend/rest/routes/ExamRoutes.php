<?php




/**
 * @OA\Get(
 *     path="/connection-check",
 *     tags={"Connection"},
 *     summary="Get connection check",
 *     @OA\Response(
 *         response=200,
 *         description="Get connection check"
 *     )
 * )
 */

Flight::route('GET /connection-check', function(){
    /** TODO
    * This endpoint prints the message from constructor within ExamDao class
    * Goal is to check whether connection is successfully established or not
    * This endpoint does not have to return output in JSON format
    * 5 points
    */

    Flight::examService();
});

/**
 * @OA\Get(
 *     path="/customers",
 *     tags={"Customers"},
 *     summary="Get all customers",
 *     @OA\Response(
 *         response=200,
 *         description="Get all customers"
 *     )
 * )
 */

Flight::route('GET /customers', function(){
    /** TODO
    * This endpoint returns list of all customers that will be used
    * to populate the <select> list
    * This endpoint should return output in JSON format
    * 10 points
    */
    $examService = Flight::examService();
    $data = $examService->get_customers();
    Flight::json($data);
});

/**
 * @OA\Get(
 *     path="/customer/meals/{customer_id}",
 *     tags={"Customers"},
 *     summary="Get all meals for a specific customer",
 *     
 *     @OA\Response(
 *         response=200,
 *         description="Get customer meals"
 *     ),
 * @OA\Parameter(
 *         name="customer_id",
 *         in="path",
 *         required=true,
 *         description="The ID of the customer to fetch meals for",
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 * )
 */

Flight::route('GET /customer/meals/@customer_id', function($customer_id){
    /** TODO
    * This endpoint returns array of all meals for a specific customer
    * Every item in the array should have following properties
    *   `food_name` -> name of the food that customer eat for the meal
    *   `food_brand` -> brand of the food that customer eat for the meal
    *   `meal_date` -> date when the customer eat the meal
    * This endpoint should return output in JSON format
    * 10 points
    */
    $examService = Flight::examService();
    $data = $examService->get_customer_meals($customer_id);
    Flight::json($data);

});

/**
 * @OA\Post(
 *     path="/customers/add",
 *     tags={"Customers"},
 *     summary="This endpoint should add the customer to the database",
 *     @OA\Response(
 *         response=200,
 *         description="Customer added to database"
 *     ),
 *     @OA\RequestBody(
 *         description="Customer data payload",
 *         @OA\JsonContent(
 *             required={"first_name", "last_name", "birth_date"},
 *             @OA\Property(property="first_name", type="string", example="Emina"),
 *             @OA\Property(property="last_name", type="string", example="Peljto"),
 *             @OA\Property(property="birth_date", type="string", example="2000-01-01")
 *         )
 *     )
 * )
 */

Flight::route('POST /customers/add', function() {
    /** TODO
    * This endpoint should add the customer to the database
    * The data that will come from the form (if you don't change
    * the template form) has following properties
    *   `first_name` -> first name of the customer
    *   `last_name` -> last name of the customer
    *   `birth_date` -> date when the customer has been born
    * This endpoint should return the added customer in JSON format
    * 10 points
    */
    $examService = Flight::examService();
    $data = Flight::request()->data->getData();
    $result=$examService->add_customer($data);
    Flight::json($result);
});

/**
 * @OA\Get(
 *     path="/foods/report",
 *     tags={"Foods"},
 *     summary="Get foods report",
 *     @OA\Response(
 *         response=200,
 *         description="Get foods report"
 *     )
 * )
 */

Flight::route('GET /foods/report', function(){
    /** TODO
    * This endpoint should return the array of all foods from the database
    * together with the image of the foods. This endpoint should be fully
    * paginated. Every food returned should have following properties:
    *   `name` -> name of the food
    *   `brand` -> brand of the food
    *   `image` -> <img> of the food
    *   `energy` -> total amount of calories (energy) of the food
    *   `protein` -> total amount of proteins of the food
    *   `fat` -> total amount of fat of the food
    *   `fiber` -> total amount of fiber of the food
    *   `carbs` -> total amount of carbs of the food
    * This endpoint should return output in JSON format
    * 15 points
    */
    $examService = Flight::examService();
    $data = $examService->get_foods_report();
    Flight::json($data);
});

//**Delete */


/**
 * @OA\Delete(
 *      path="/delete/{food_id}",
 *      tags={"Foods"},
 *      summary="Delete current user",
 *      security={
 *         {"ApiKey": {}}
 *      },
 *      @OA\Response(
 *           response=200,
 *           description="User deleted"
 *      ), 
 *     @OA\Parameter(@OA\Schema(type="number"), in="query", name="user_id", example="1", description="User ID")
 * )
 */



Flight::route('DELETE /delete/@food_id', function ($food_id) {
    if($food_id == NULL || $food_id == '') {
        Flight::halt(500, "Required parameters are missing!");
    }

    $examService = Flight::examService();
    $examService->delete_food($food_id);
    
    Flight::json(['data' => NULL, 'message' => "You have successfully deleted the patient"]);
});

//**Get all foods */

Flight::route('GET /foods', function(){
    $examService = Flight::examService();
    $data = $examService->get_foods();
    Flight::json($data);
  });

//**Edit */

?>
