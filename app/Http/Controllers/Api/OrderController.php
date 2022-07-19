<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderPostRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection(Order::all());
    }


    /**
     * @param OrderPostRequest $request
     * @return OrderResource
     */
    public function store(OrderPostRequest $request): OrderResource
    {
        $order = Order::query()->create($request->all());

        return new OrderResource($order);
    }


    /**
     * @param $id
     * @return OrderResource|\Illuminate\Http\JsonResponse|object
     */
    public function show($id)
    {
        try {
            $order = Order::query()->findOrFail($id);
        }catch (ModelNotFoundException $exception){
            return response()
                ->json(['data' => null, 'message' => 'User not found'])
                ->setStatusCode(404);
        }

        return new OrderResource($order);
    }


    /**
     * @param OrderPostRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(OrderPostRequest $request, Order $order): OrderResource
    {
        $order->update($request->all());

        return new OrderResource($order);
    }

    /**
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        $order->delete();

        return response(null, 204);
    }
}
