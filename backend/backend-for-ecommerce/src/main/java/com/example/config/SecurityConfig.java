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
            .csrf().disable() // Disable CSRF for testing
            .cors().and() // Enable CORS
            .authorizeHttpRequests(auth -> auth
                .requestMatchers("/api/**").permitAll() // Allow all API routes
                .anyRequest().authenticated()
            )
            .httpBasic().disable()
            .formLogin().disable();

        return http.build();
    }
}
