<?php
// Activam afisarea erorilor pentru debugging (doar pentru dezvoltare)
// Enable error display for debugging (for development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificam daca formularul a fost trimis folosind metoda POST
// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtinem datele din formular si verificam daca exista
    // Retrieve form data and check if it exists
    $name = isset($_POST["name"]) ? htmlspecialchars($_POST["name"]) : '';
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : '';
    $age = isset($_POST["number"]) ? htmlspecialchars($_POST["number"]) : '';
    $experience = isset($_POST["dropdown"]) ? htmlspecialchars($_POST["dropdown"]) : '';
    $device = isset($_POST["device"]) ? htmlspecialchars($_POST["device"]) : '';
    $suggestions = isset($_POST["question"]) ? htmlspecialchars($_POST["question"]) : '';

    // Verificam daca interesele sunt setate si le convertim intr-un string
    // Check if interests are set and convert them into a string
    $interests = isset($_POST["interests"]) ? $_POST["interests"] : [];
    $interests_str = implode(", ", $interests);  // Combina valorile multiple intr-un singur string // Combine multiple values into a single string
    // Salvam datele intr-un fișier
    // Save the data to a file
    $file = fopen("submissions.txt", "a"); // Modul "a" asigura ca toate datele din fiecare trimitere vor fi salvate consecutiv în fisier, astfel incat sa ai un istoric complet al tuturor formularelor trimise
    // The "a" mode ensures that all data from each submission will be saved consecutively in the file, allowing you to have a complete history of all submitted forms
    if ($file) {
        // Scriem datele în fisier
        // Write the data to the file
        fwrite($file, "Name: $name\nEmail: $email\nAge: $age\nExperience: $experience\nPreferred Device: $device\nInterests: $interests_str\nSuggestions: $suggestions\n\n");
        fclose($file);

        // Redirectionam utilizatorul catre o pagina de confirmare
        // Redirect the user to a confirmation page
        header("Location: thank_you.html");
        exit();
    } else {
        // Afisam un mesaj de eroare dacă fiaierul nu poate fi deschis
        echo "Eroare: Nu se poate deschide fisierul submissions.txt."; // Display an error message if the file cannot be opened
    }
} else {
    echo "Formularul nu a fost trimis corect.";
}
