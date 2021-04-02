<?php


namespace App\Factory;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Productos;

class OrderFactory
{
    /**
     * Crear un pedido.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    /**
     * Crea un item de un producto.
     *
     * @param Productos $product
     *
     * @return OrderItem
     */
    public function createItem(Productos $product): OrderItem
    {
        $item = new OrderItem();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}