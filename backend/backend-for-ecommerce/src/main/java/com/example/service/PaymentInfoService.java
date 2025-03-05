package com.example.service;

import com.example.model.PaymentInfo;
import com.example.repository.PaymentInfoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class PaymentInfoService {

    @Autowired
    private PaymentInfoRepository paymentInfoRepository;

    public PaymentInfo createPayment(PaymentInfo paymentInfo) {
        return paymentInfoRepository.save(paymentInfo);
    }

    public List<PaymentInfo> getAllPayments() {
        return paymentInfoRepository.findAll();
    }

    public Optional<PaymentInfo> getPaymentById(Long id) {
        return paymentInfoRepository.findById(id);
    }

    public PaymentInfo updatePayment(Long id, PaymentInfo updatedPayment) {
        return paymentInfoRepository.findById(id).map(payment -> {
            payment.setPaymentMethod(updatedPayment.getPaymentMethod());
            payment.setPaymentStatus(updatedPayment.getPaymentStatus());
            return paymentInfoRepository.save(payment);
        }).orElseThrow(() -> new RuntimeException("Payment not found"));
    }

    public void deletePayment(Long id) {
        paymentInfoRepository.deleteById(id);
    }
}
