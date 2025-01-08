<?= $this->extend('layout/template')?>
<?= $this->section('content'); ?>

<style>

    /* Contenedor principal */
    .container2 {
        width: 90%;
        max-width: 1200px;
        height: 80vh;
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
        font-family: "Roboto";
        margin-top: 50px;
        margin-bottom: 50px;
        padding-top: 10px;
    }

    .Enc{
        font-size: 1.4em;
        color: #333;
        font-family: 'Roboto';
    }
    .header2 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        position: sticky;
        top: 0;
        background: #ffffff;
        padding: 15px 0;
        z-index: 1;
    }

    .header2 button {
        padding: 10px 15px;
        border: none;
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .header2 button:hover {
        background-color: #0056b3;
    }

    .file-list {
        list-style: none;
        padding: 0;
        margin-top: 15px;
        max-height: 60vh; /* Altura máxima para el contenedor de lista */
        overflow-y: auto; /* Scroll vertical */
    }

    .file-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
        margin-bottom: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .file-info {
        display: flex;
        align-items: center;
        width: 60%;
    }

    .file-info img {
        width: 40px;
        margin-right: 15px;
    }

    .file-info span {
        font-weight: 500;
        color: #333;
    }

    .file-date {
        font-size: 0.9em;
        color: #666;
        margin-left: 10px;
    }

    .file-actions {
        display: flex;
        gap: 10px;
    }

    .file-actions button, .file-actions .download-btn {
        padding: 8px 12px;
        border: none;
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .file-actions .download-btn {
        background-color: #28a745;
    }

    .file-actions .download-btn:hover {
        background-color: #218838;
    }

    .file-actions .delete-btn {
        background-color: #dc3545;
    }

    .file-actions .delete-btn:hover {
        background-color: #c82333;
    }

    /* Modal */
    .modal3 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Asegura que el modal esté encima de otros elementos */
    }

    .modal-content3 {
        background-color: #fff;
        padding: 25px;
        border-radius: 12px;
        width: 320px;
        text-align: center;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease;
    }

    .modal-content3 h3 {
        color: #333;
        margin-bottom: 15px;
    }

    .modal-content3 input, .modal-content3 button {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 1em;
    }

    .modal-content3 input:focus {
        outline: none;
        border-color: #007bff;
    }

    .modal-content3 .save-btn {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
        border: none;
    }

    .modal-content3 .save-btn:hover {
        background-color: #0056b3;
    }

    .close-btn {
        background-color: #6c757d;
        color: #fff;
        border: none;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .close-btn:hover {
        background-color: #5a6268;
    }

    /* Animación del modal */
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .centro2{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>



<div class="centro2">
    <div class="container2">
        <div class="header2">
            <h1 class="Enc">Lista de formatos en PDF</h1>
            <button onclick="openModal()">Agregar PDF</button>
        </div>
        <ul class="file-list" id="fileList">
            <!-- Lista de archivos PDF cargados -->
        </ul>
    </div>

    <!-- Modal para agregar archivo -->
    <div class="modal3" id="modal3">
        <div class="modal-content3">
            <h3>Agregar Nuevo PDF</h3>
            <input type="text" id="fileName" placeholder="Nombre del archivo" required>
            <input type="file" id="fileInput" accept=".pdf" required>
            <button class="save-btn" onclick="addFile()">Guardar</button>
            <button class="close-btn" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</div>

<script>
    const fileList = document.getElementById('fileList');
    const modal = document.getElementById('modal3');

    function openModal() {
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    function addFile() {
        const fileName = document.getElementById('fileName').value;
        const fileInput = document.getElementById('fileInput').files[0];
        const currentDate = new Date().toLocaleDateString('es-ES', {
            day: '2-digit', month: '2-digit', year: 'numeric'
        });

        if (fileName && fileInput && fileInput.type === "application/pdf") {
            const fileUrl = URL.createObjectURL(fileInput);

            const fileItem = document.createElement('li');
            fileItem.classList.add('file-item');

            fileItem.innerHTML = `
                <div class="file-info">
                    <img src="https://img.icons8.com/ios-filled/50/000000/pdf.png" alt="PDF Icon">
                    <span>${fileName}</span>
                    <span class="file-date">Subido el: ${currentDate}</span>
                </div>
                <div class="file-actions">
                    <a href="${fileUrl}" download="${fileName}.pdf">
                        <button class="download-btn">Descargar</button>
                    </a>
                    <button class="delete-btn" onclick="removeFile(this)">Eliminar</button>
                </div>
            `;

            fileList.appendChild(fileItem);
            closeModal();
            document.getElementById('fileName').value = '';
            document.getElementById('fileInput').value = '';
        } else {
            alert('Por favor, completa todos los campos y asegúrate de que el archivo es un PDF');
        }
    }

    function removeFile(button) {
        button.parentElement.parentElement.remove();
    }
    
</script>
<?= $this->endSection(); ?>