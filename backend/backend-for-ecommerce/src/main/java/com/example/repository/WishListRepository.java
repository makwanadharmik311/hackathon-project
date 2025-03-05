package com.example.repository;

import com.example.model.WishList;
import com.example.model.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface WishListRepository extends JpaRepository<WishList, Long> {

    List<WishList> findByUser(User user); // Find WishList by User

    void deleteByUser(User user); // Delete WishList by User
}
