<?php
// TODO delete this file
//
// namespace App\Http\Middleware;
//
// use Closure;
// use JWTAuth;
// use Exception;
//
// class AuthenticateWithJwt
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param \Illuminate\Http\Request $request
//      * @param \Closure                 $next
//      * @return mixed
//      */
//     public function handle($request, Closure $next)
//     {
//
//         try {
//             $user = JWTAuth::parseToken()->toUser();
//         } catch (Exception $e) {
//             if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
//                 return response()->json(['error' => 'Token is Invalid'], 401);
//             } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
//                 return response()->json(['error' => 'Token is Expired'], 401);
//             } else {
//                 return response()->json(['error' => $e->getMessage()], 422);
//                 // return response()->json(['error' => 'Something is wrong']);
//             }
//         }
//
//         return $next($request);
//     }
// }
