package com.example.model;

import com.fasterxml.jackson.annotation.JsonBackReference;
import com.fasterxml.jackson.annotation.JsonIgnore;

import jakarta.persistence.*;
import lombok.*;

@Entity
@Data
@AllArgsConstructor
@NoArgsConstructor
public class Product {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long productId;

    
    private String productName;
    private String description;
    private double price;

    @ManyToOne
    @JoinColumn(name = "category_id")
    @JsonBackReference
    @JsonIgnore
    private Category category;
}
