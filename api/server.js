const express = require("express");
const mysql = require("mysql2");
const bodyParser = require("body-parser");
const cors = require("cors");
const db = require('./db');

const app = express();

// Middleware
app.use(cors());
app.use(bodyParser.json());

// Test API Route
app.get('/users', (req, res) => {
  db.query('SELECT * FROM users', (err, results) => {
    if (err) {
      res.status(500).json({ error: err.message });
      return;
    }
    res.json(results);
  });
});

// Start Server
const PORT = process.env.PORT || 3000;

// API Route to Receive Data
app.post("/sensor", (req, res) => {
  const { temperature, humidity } = req.body;

  if (temperature === undefined || humidity === undefined) {
      return res.status(400).json({ error: "Invalid data" });
  }

  const sql = "INSERT INTO sensor_data (temperature, humidity) VALUES (?, ?)";
  db.query(sql, [temperature, humidity], (err, result) => {
      if (err) {
          console.error("Error inserting data:", err);
          return res.status(500).json({ error: "Database error" });
      }
      res.json({ message: "Data inserted successfully", id: result.insertId });
  });
});

// Start Server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});