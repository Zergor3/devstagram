import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("success", function (file, response) {
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("error", function (file, errorMessage, xhr) {
    // Este evento se dispara cuando hay un error durante la carga del archivo

    // 'file' es el objeto de archivo que causó el error
    // 'errorMessage' es el mensaje de error proporcionado por el servidor
    // 'xhr' es el objeto XMLHttpRequest que contiene información sobre la solicitud

    console.log(errorMessage);

    // Puedes realizar acciones adicionales según el tipo de error
    alert("Error al cargar el archivo: " + errorMessage);
});

dropzone.on("removedfile", function () {
    document.querySelector('[name="imagen"]').value = "";
});
