package com.example.service;

import com.example.model.PaymentInfo;
import com.example.repository.PaymentInfoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PaymentInfoService {

    @Autowired
    private PaymentInfoRepository paymentInfoRepository;

    public PaymentInfo savePaymentInfo(PaymentInfo paymentInfo) {
        return paymentInfoRepository.save(paymentInfo);
    }

    public List<PaymentInfo> getAllPayments() {
        return paymentInfoRepository.findAll();
    }

    public PaymentInfo getPaymentById(Long id) {
        return paymentInfoRepository.findById(id).orElse(null);
    }

    public PaymentInfo updatePaymentInfo(PaymentInfo paymentInfo) {
        return paymentInfoRepository.save(paymentInfo);
    }

    public void deletePaymentInfo(Long id) {
        paymentInfoRepository.deleteById(id);
    }
}