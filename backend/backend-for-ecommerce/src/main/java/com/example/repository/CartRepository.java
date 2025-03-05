package com.example.repository;

import com.example.model.Cart;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface CartRepository extends JpaRepository<Cart, Long> {

    List<Cart> findByUserUserId(Long userId); // Find Cart by User ID
    
    void deleteByUserUserId(Long userId); // Delete Cart by User ID
}
