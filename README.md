# Laravel Encryption Lab

This project demonstrates the use of Laravel's encryption capabilities, including both secure and insecure methods for educational purposes.

## Prerequisites

- Docker installed on your system
- Basic understanding of Laravel and Docker

## Getting Started

1. Clone this repository:
   ```
   git clone <repository-url>
   cd laravel-encryption-lab
   ```

2. Build the Docker image:
   ```
   docker build -t laravel-encryption-lab .
   ```

3. Run the Docker container:
   ```
   docker run -p 8000:80 -d laravel-encryption-lab
   ```

4. Access the application by navigating to `http://localhost:8000` in your web browser.

## Using the Application

1. Register a new user account or log in if you already have one.

2. Once logged in, you'll see a form to input sensitive data.

3. Choose between "secure" and "insecure" encryption modes:
   - Secure mode uses Laravel's built-in encryption (AES-256-CBC)
   - Insecure mode uses a weak custom encryption (for demonstration only)

4. Submit the form to encrypt and store the data.

5. View the list of stored encrypted data.

6. Use the "Decrypt" button next to each entry to view the decrypted data.

## Security Note

The "insecure" mode is for educational purposes only and should never be used in a real-world application.

## Troubleshooting

If you encounter any issues:

1. Check the Docker container logs:
   ```
   docker logs <container-id>
   ```

2. Access the container's shell:
   ```
   docker exec -it <container-id> bash
   ```

3. Inside the container, you can run Laravel commands like:
   ```
   php artisan migrate
   php artisan tinker
   ```

## Modifying the Application

1. Make changes to the Laravel files on your host machine.
2. Rebuild the Docker image:
   ```
   docker build -t laravel-encryption-lab .
   ```
3. Stop the old container:
   ```
   docker stop <container-id>
   ```
4. Run a new container with the updated image:
   ```
   docker run -p 8000:80 -d laravel-encryption-lab
   ```

## Contributing

Feel free to fork this project and submit pull requests for improvements or additional features.

## License

This project is open-sourced software licensed under the MIT license.