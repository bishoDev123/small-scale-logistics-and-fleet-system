CREATE DATABASE IF NOT EXISTS sslf;

USE sslf;

CREATE TABLE roles (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(50) NOT NULL
);

INSERT INTO roles (id, name) VALUES
                                 (1, 'Admin'),
                                 (2, 'Dispatcher'),
                                 (3, 'Driver'),
                                 (4, 'Customer');

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(50) NOT NULL,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       password VARCHAR(100) NOT NULL,
                       role_id INT NOT NULL,
                       employee_code VARCHAR(50) DEFAULT NULL,

                       FOREIGN KEY (role_id)
                           REFERENCES roles(id)
);

INSERT INTO users (
    name,
    email,
    password,
    role_id,
    employee_code
)
VALUES
    (
        'Alice',
        'alice@gmail.com',
        '12345678',
        4,
        NULL
    ),
    (
        'Driver User',
        'driver@gmail.com',
        '12345678',
        3,
        'DRIVER123'
    ),
    (
        'Dispatcher User',
        'dispatcher@gmail.com',
        '12345678',
        2,
        'DISPATCH456'
    );

CREATE TABLE vehicles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          capacity FLOAT NOT NULL,
                          type INT NOT NULL,
                          status VARCHAR(50)
);

CREATE TABLE drivers (
                         user_id INT PRIMARY KEY,
                         license VARCHAR(50) NOT NULL,
                         assigned_vehicle INT DEFAULT NULL,
                         assigned_delivery INT DEFAULT NULL,
                         performance_score INT NOT NULL,

                         FOREIGN KEY (user_id)
                             REFERENCES users(id)
);

CREATE TABLE deliveries (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            driver_id INT NOT NULL,
                            customer_id INT NOT NULL,
                            target_address VARCHAR(100) NOT NULL,
                            estimated_arrival_time INT DEFAULT NULL,
                            status VARCHAR(50),

                            FOREIGN KEY (customer_id)
                                REFERENCES users(id),

                            FOREIGN KEY (driver_id)
                                REFERENCES drivers(user_id)
);

CREATE TABLE packages (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          ordered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          arrival_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          weight FLOAT NOT NULL,
                          priority_score FLOAT NOT NULL,
                          status VARCHAR(50) NOT NULL,
                          delivery_id INT DEFAULT NULL,

                          FOREIGN KEY (delivery_id)
                              REFERENCES deliveries(id)
);

CREATE TABLE feedback (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          rating INT,
                          comment TEXT,
                          delivery_id INT NOT NULL,

                          FOREIGN KEY (delivery_id)
                              REFERENCES deliveries(id)
);

CREATE TABLE maintenance_records (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                     cost INT NOT NULL,
                                     description TEXT NOT NULL,
                                     vehicle_id INT NOT NULL,

                                     FOREIGN KEY (vehicle_id)
                                         REFERENCES vehicles(id)
);

CREATE TABLE parts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(50) NOT NULL,
                       max_life INT NOT NULL,
                       current_usage INT NOT NULL
);

CREATE TABLE audit_log (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           action VARCHAR(50) NOT NULL,
                           time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);