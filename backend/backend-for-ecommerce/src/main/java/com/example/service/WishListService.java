package com.example.service;

import com.example.model.WishList;
import com.example.model.User;
import com.example.repository.WishListRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class WishListService {

    @Autowired
    private WishListRepository wishListRepository;

    public List<WishList> getWishListByUser(User user) {
        return wishListRepository.findByUser(user);
    }

    public List<WishList> getAllItems() {
        return wishListRepository.findAll();
    }

    public WishList addToWishList(WishList wishList) {
        return wishListRepository.save(wishList);
    }

    public WishList updateWishList(WishList wishList) {
        return wishListRepository.save(wishList);
    }

    public void deleteWishListById(Long id) {
        wishListRepository.deleteById(id);
    }

    public void deleteWishListByUser(User user) {
        wishListRepository.deleteByUser(user);
    }
}