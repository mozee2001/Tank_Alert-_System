// Tank_Alert-_System
Tank alert system to send notifications 
//Tank Alert System

This project is a PHP-based system to monitor tank/bonnet status using Arduino and display data on a web interface.

---

//💻 Prerequisites

- XAMPP (Apache + MySQL + PHP)
- Arduino IDE
- Wi-Fi capable Arduino board (e.g., Arduino Uno WiFi, ESP32)

---
// 🛠 Installing XAMPP

Follow these steps to install XAMPP on your computer:

//Windows / macOS / Linux

1. Go to the [XAMPP official website](https://www.apachefriends.org/index.html) and download the latest version for your OS.
2. Run the installer and follow the prompts:
   - Choose components: ensure **Apache** and **MySQL** are selected.
   - Select installation folder (default is usually fine, e.g., `C:\xampp` on Windows).
3. Launch **XAMPP Control Panel**:
   - Start **Apache** (web server)  
   - Start **MySQL** (database server)
4. Test the installation:
   - Open your browser and go to `http://localhost/`
   - You should see the XAMPP welcome page.

---
// 📂 Setting up the Tank Alert System

1. Copy the project folder (`Tank_Alert-_System`) to the XAMPP `htdocs` directory:
   - Windows: `C:\xampp\htdocs\Tank_Alert-_System`
   - macOS/Linux: `/opt/lampp/htdocs/Tank_Alert-_System`
2. Open your browser and navigate to: see your application .
3. 3. You should see the **Tank Status Monitor** interface.

---

// ⚙ Arduino Setup

- Upload the Arduino sketch from `/arduino/` folder  
- Update the `serverIP` in the sketch to your computer’s local IP  
- Ensure your Arduino is connected to the same Wi-Fi network as your PC running XAMPP  

---

- The system logs tank/bonnet status to the MySQL database  
- Make sure your MySQL database and table (`tank_logs`) are correctly set up  
- PHP handles timestamps automatically



