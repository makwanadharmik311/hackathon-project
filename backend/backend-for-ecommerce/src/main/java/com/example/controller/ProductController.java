package com.example.controller;

import com.example.model.Product;
import com.example.service.ProductService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/products")
public class ProductController {

    @Autowired
    private ProductService productService;

    @PostMapping("/add")
    public Product addProduct(@RequestBody Product product) {
        return productService.addProduct(product);
    }

    @GetMapping("/")
    public List<Product> getAllProducts() {
        return productService.getAllProducts();
    }

    @GetMapping("/category/{categoryId}")
    public List<Product> getProductsByCategory(@PathVariable Long categoryId) {
        return productService.getProductsByCategory(categoryId);
    }

    @GetMapping("/search")
    public List<Product> searchProducts(@RequestParam String productName) {
        return productService.searchProducts(productName);
    }

    @PutMapping("/update/{productId}")
    public Product updateProduct(@PathVariable Long productId, @RequestBody Product product) {
        return productService.updateProduct(productId, product);
    }

    @DeleteMapping("/delete/{productId}")
    public String deleteProduct(@PathVariable Long productId) {
        productService.deleteProduct(productId);
        return "Product deleted successfully!";
    }
}

