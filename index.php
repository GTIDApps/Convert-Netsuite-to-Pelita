<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #ffffff;
        }

        h1 {
            color: #4f2d7f;
            font-size: 2.5rem;
            margin: 2rem 0;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            background: #f0f0f0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .tab-button.active {
            background: #4f2d7f;
            color: white;
        }

        .upload-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .upload-form {
            display: none;
        }

        .upload-form.active {
            display: block;
        }

        .drop-zone {
            border: 2px dashed #ccc;
            border-radius: 4px;
            padding: 40px;
            text-align: center;
            margin: 20px 0;
            cursor: pointer;
            transition: border 0.3s ease;
        }

        .drop-zone:hover {
            border-color: #4f2d7f;
        }

        .drop-zone p {
            color: #666;
            margin: 0;
        }

        .convert-button {
            background: #4f2d7f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .convert-button:hover {
            background: #4f2d7f;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Excel Converter</h1>
    
    <div class="tabs">
        <button class="tab-button active" onclick="switchTab('insurance')">Assurance</button>
        <button class="tab-button" onclick="switchTab('non-insurance')">Non-Assurance</button>
    </div>

    <div class="upload-container">
        <!-- Insurance Upload Form -->
        <form id="insurance-form" class="upload-form active" action="upload.php" method="post" enctype="multipart/form-data">
            <div class="drop-zone" onclick="document.getElementById('insurance_file').click()">
                <p>Choose file or drag it here</p>
            </div>
            <input type="file" name="excel_file" id="insurance_file" accept=".xlsx,.xls" required>
            <button type="submit" class="convert-button">Convert Excel</button>
        </form>

        <!-- Non-Insurance Upload Form -->
        <form id="non-insurance-form" class="upload-form" action="upload_non_asuransi.php" method="post" enctype="multipart/form-data">
            <div class="drop-zone" onclick="document.getElementById('non_insurance_file').click()">
                <p>Choose file or drag it here</p>
            </div>
            <input type="file" name="excel_file" id="non_insurance_file" accept=".xlsx,.xls" required>
            <button type="submit" class="convert-button">Convert Excel</button>
        </form>
    </div>

    <script>
        function switchTab(type) {
            // Update tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update forms
            document.querySelectorAll('.upload-form').forEach(form => {
                form.classList.remove('active');
            });
            if (type === 'insurance') {
                document.getElementById('insurance-form').classList.add('active');
            } else {
                document.getElementById('non-insurance-form').classList.add('active');
            }
        }

        // Handle drag and drop for both forms
        function setupDragAndDrop(formId, fileInputId) {
            const dropZone = document.querySelector(`#${formId} .drop-zone`);
            const fileInput = document.getElementById(fileInputId);

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = '#4CAF50';
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = '#ccc';
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.style.borderColor = '#ccc';
                fileInput.files = e.dataTransfer.files;
                if (fileInput.files.length > 0) {
                    dropZone.querySelector('p').textContent = fileInput.files[0].name;
                }
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    dropZone.querySelector('p').textContent = fileInput.files[0].name;
                }
            });
        }

        // Setup drag and drop for both forms
        setupDragAndDrop('insurance-form', 'insurance_file');
        setupDragAndDrop('non-insurance-form', 'non_insurance_file');
    </script>
</body>
</html>