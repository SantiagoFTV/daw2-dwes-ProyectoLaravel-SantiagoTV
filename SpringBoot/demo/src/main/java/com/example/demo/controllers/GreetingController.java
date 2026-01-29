package com.example.demo.controllers;

import java.util.concurrent.atomic.AtomicLong;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.models.Greeting;



// Rest controller para iniciar el controlador
@RestController()
public class GreetingController {

    private static final String template = "Hello, %s! "; // %s Lo podremos sustituir por el nombre de usuario que queramos
    private final AtomicLong counter = new AtomicLong(); // Contador que se inicializa en 0

    @GetMapping()

    public Greeting greeting(
        @RequestParam(value = "name", defaultValue = "World") String name
    ) {
        return new Greeting(counter.incrementAndGet(), template.formatted(name));

    }
}
