package com.example.controller;

import com.example.model.Order;
import com.example.service.OrderService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/orders")
public class OrderController {

    @Autowired
    private OrderService orderService;

    @PostMapping("/add")
    public Order createOrder(@RequestBody Order order) {
        return orderService.createOrder(order);
    }

    @GetMapping("/user/{userId}")
    public List<Order> getOrdersByUser(@PathVariable Long userId) {
        return orderService.getOrdersByUser(userId);
    }

    @GetMapping("/")
    public List<Order> getAllOrders() {
        return orderService.getAllOrders();
    }

    @PutMapping("/update")
    public Order updateOrder(@RequestBody Order order) {
        return orderService.updateOrder(order);
    }

    @DeleteMapping("/delete/{orderId}")
    public ResponseEntity<?> deleteOrder(@PathVariable Long orderId) {
        orderService.deleteOrder(orderId);
        return ResponseEntity.ok().build();
    }
}
