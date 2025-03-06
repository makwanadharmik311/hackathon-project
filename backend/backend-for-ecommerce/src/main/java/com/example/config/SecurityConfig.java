package com.example.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
            .csrf().disable()
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/api/users/**","/api/categories/**","/api/products/**","/api/cart/**","/api/wishlist/**","/api/payments/**","/api/orders/**").permitAll() // Allow public access
                .anyRequest().authenticated()
            )
            .httpBasic(); // Enable basic authentication if needed

        return http.build();
    }
}

