package com.example.service;

import com.example.model.Cart;
import com.example.repository.CartRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class CartService {

    @Autowired
    private CartRepository cartRepository;

    public Cart addToCart(Cart cart) {
        return cartRepository.save(cart);
    }

    // Get all carts
    public List<Cart> getAllCarts() {
        return cartRepository.findAll();
    }

    public List<Cart> getUserCart(Long userId) {
        return cartRepository.findByUserUserId(userId);
    }

    public void clearCart(Long userId) {
        cartRepository.deleteByUserUserId(userId);
    }

    // Get a cart by ID
    public Cart getCartById(Long cartId) {
        return cartRepository.findById(cartId).orElseThrow(() -> new RuntimeException("Cart not found"));
    }

    // Update a cart (e.g., adding/removing products)
    public Cart updateCart(Long cartId, Cart updatedCart) {
        Cart existingCart = getCartById(cartId);
        existingCart.setProducts(updatedCart.getProducts()); // Update products
        return cartRepository.save(existingCart);
    }

    // Delete a cart by ID
    public void deleteCart(Long cartId) {
        Cart cart = getCartById(cartId);
        cartRepository.delete(cart);
    }
}
