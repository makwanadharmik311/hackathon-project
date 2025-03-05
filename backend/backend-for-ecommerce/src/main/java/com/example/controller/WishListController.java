package com.example.controller;

import com.example.model.WishList;
import com.example.model.User;
import com.example.service.WishListService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/wishlist")
public class WishListController {

    @Autowired
    private WishListService wishListService;

    @GetMapping("/{userId}")
    public List<WishList> getWishListByUser(@PathVariable Long userId, @RequestBody User user) {
        user.setUserId(userId);
        return wishListService.getWishListByUser(user);
    }

    @GetMapping("/")
    public List<WishList> getAllItems() {
        return wishListService.getAllItems();
    }

    @PostMapping("/add")
    public WishList addToWishList(@RequestBody WishList wishList) {
        return wishListService.addToWishList(wishList);
    }

    @PutMapping("/update")
    public WishList updateWishList(@RequestBody WishList wishList) {
        return wishListService.updateWishList(wishList);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> deleteWishListById(@PathVariable Long id) {
        wishListService.deleteWishListById(id);
        return ResponseEntity.ok().build();
    }
}