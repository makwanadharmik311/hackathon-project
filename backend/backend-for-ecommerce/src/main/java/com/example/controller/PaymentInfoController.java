package com.example.controller;

import com.example.model.PaymentInfo;
import com.example.service.PaymentInfoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/payments")
public class PaymentInfoController {

    @Autowired
    private PaymentInfoService paymentInfoService;

    @PostMapping("/add")
    public PaymentInfo addPayment(@RequestBody PaymentInfo paymentInfo) {
        return paymentInfoService.savePaymentInfo(paymentInfo);
    }

    @GetMapping("/")
    public List<PaymentInfo> getAllPayments() {
        return paymentInfoService.getAllPayments();
    }

    @GetMapping("/{id}")
    public PaymentInfo getPaymentById(@PathVariable Long id) {
        return paymentInfoService.getPaymentById(id);
    }

    @PutMapping("/update")
    public PaymentInfo updatePayment(@RequestBody PaymentInfo paymentInfo) {
        return paymentInfoService.updatePaymentInfo(paymentInfo);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> deletePayment(@PathVariable Long id) {
        paymentInfoService.deletePaymentInfo(id);
        return ResponseEntity.ok().build();
    }
}