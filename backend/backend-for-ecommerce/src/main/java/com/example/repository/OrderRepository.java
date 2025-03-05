package com.example.repository;

import com.example.model.Order;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface OrderRepository extends JpaRepository<Order, Long> {

    List<Order> findByUserUserId(Long userId); // Find Orders by User ID

    List<Order> findByStatus(String status); // Find Orders by Status

}
