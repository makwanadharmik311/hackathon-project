package com.example.model;

import jakarta.persistence.*;
import lombok.*;

@Entity
@Data
@AllArgsConstructor
@NoArgsConstructor
public class Order {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long orderId;

    @ManyToOne
    @JoinColumn(name = "user_id")
    private User user;

    @Column(nullable = false)
    private String status;  // Make sure this field exists

    @OneToOne(mappedBy = "order", cascade = CascadeType.ALL)
    private PaymentInfo paymentInfo;
}
