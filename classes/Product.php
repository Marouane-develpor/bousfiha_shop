<?php
require_once 'Database.php';

class Product
{
    private $conn;
    private $table_name = "products";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProducts(): array
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromotionalProducts(): array
    {
        // Assuming promotional products have an old_price set or a 'Promo' badge
        $query = "SELECT * FROM " . $this->table_name . " WHERE old_price IS NOT NULL AND old_price > price";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByCategory($category): array
    {
        // We can search by category name if the table has it, or join with categories table
        // Based on current schema, products table likely has 'category_name' or similar if denormalized, 
        // or we need to join. The previous mock data had 'category' string.
        // Let's assume the table has 'category_name' as per the schema we saw earlier.

        $query = "SELECT * FROM " . $this->table_name . " WHERE category_name = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category", $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories(): array
    {
        $query = "SELECT DISTINCT category_name FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row['category_name'];
        }
        return $categories;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
