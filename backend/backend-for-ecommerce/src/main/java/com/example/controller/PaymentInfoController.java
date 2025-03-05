package com.example.controller;

import com.example.model.PaymentInfo;
import com.example.service.PaymentInfoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/payments")
public class PaymentInfoController {

    @Autowired
    private PaymentInfoService paymentInfoService;

    @PostMapping
    public PaymentInfo createPayment(@RequestBody PaymentInfo paymentInfo) {
        return paymentInfoService.createPayment(paymentInfo);
    }

    @GetMapping
    public List<PaymentInfo> getAllPayments() {
        return paymentInfoService.getAllPayments();
    }

    @GetMapping("/{id}")
    public Optional<PaymentInfo> getPaymentById(@PathVariable Long id) {
        return paymentInfoService.getPaymentById(id);
    }

    @PutMapping("/{id}")
    public PaymentInfo updatePayment(@PathVariable Long id, @RequestBody PaymentInfo updatedPayment) {
        return paymentInfoService.updatePayment(id, updatedPayment);
    }

    @DeleteMapping("/{id}")
    public String deletePayment(@PathVariable Long id) {
        paymentInfoService.deletePayment(id);
        return "Payment deleted successfully";
    }
}
