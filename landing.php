
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grant Thornton - GTID Convert Tools</title>
</head>
<style>

    /* styles.css */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #e6e6e6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header Styles */
header {
    background-color: #fff;
    padding: 25px 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    background-color:#fff;
    justify-content: flex-start;
}

.logo img {
    width: 200px;
    margin: 0;
}

/* Hero Section */
.hero {
    text-align: center;
    padding: 80px 0;
    
}

.hero h2 {
    font-size: 36px;
    color: #333;
    line-height: 1.3;
}

/* Tools Grid */
.tools-grid {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 100px;
}

.tool-card {
    background-color: #fff;
    border-radius: 8px;
    padding: 50px;
    width: 100%;
    max-width: 400px;
    position: relative;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.tool-icon img {
    width: 40px;
    height: 40px;
    margin-bottom: 20px;
}

.tool-card h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #333;
}

.tool-card p {
    color: #666;
    line-height: 1.5;
}

.coming-soon {
    position: absolute;
    top: 20px;
    right: 20px;
    color: #ff0000;
    font-weight: bold;
    font-size: 14px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .tools-grid {
        flex-direction: column;
        align-items: center;
    }
    
    .hero h2 {
        font-size: 28px;
    }
}
</style>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/gtindonesia.png" alt="Grant Thornton">
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="hero">
                <h2>All the tools you need for GTID convert<br>gathered in one place</h2>
            </div>

            <div class="tools-grid">
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/excel-icon.png" alt="Excel Icon">
                    </div>
                    <h3>Generate to Netsuite</h3>
                    <p>This is tools for generate template excel Netsuite.</p>
                </div>

                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/word-icon.png" alt="Word Icon">
                    </div>
                    <div class="coming-soon">Coming soon!</div>
                    <h3>Undifined</h3>
                    <p>Lorem Ipsum has been the industry's standard dummy text ever.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>