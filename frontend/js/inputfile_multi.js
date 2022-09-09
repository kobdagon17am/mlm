

$(".attachment").on("change", function (e) {
    // Permet de manipuler les fichiers de l'input file
    var type_file = $(this).data('type_file');
    var dt_multi = new DataTransfer();

    let file = this.files[0];
    let fileType = file["type"];
    let validImageTypes = [
        "image/gif",
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/svg+xml",
    ];
    if ($.inArray(fileType, validImageTypes) < 0) {
        $("#uploadImage").val("");
        $(`#uploadPreview_${type_file}`).attr("src", "");
        Swal.fire({
            icon: `warning`,
            title: `ตรวจสอบ`,
            text: `รองรับไฟล์ .jpg, .jpg, png เท่านั้น`,
            showCancelButton: false,
            confirmButtonText: "ตกลง",
            confirmButtonColor: "#3085d6",
        });
    } else {
        // $("#files-names").empty();
        for (var i = 0; i < this.files.length; i++) {
            let fileBloc = $(`<div class="file-block position-relative col-md-4"></div>`);
            let fileName = `
        <span class="name d-none">${this.files.item(i).name}</span>
        `;
            let src = URL.createObjectURL(this.files.item(i));
            fileBloc
                .append(
                    `<div class="position-absolute top-0 end-0"><span class="file-delete file-delete_${type_file}"><span>+</span></span> ${fileName}</div>`
                )
                .append(
                    `<div><img src="${src}" alt="preview" class="object-cover mx-auto " /></div>`
                );
            $(`#filesList_${type_file} > #files-names_${type_file}`).append(fileBloc);
        }

        for (let file of this.files) {
            dt_multi.items.add(file);
        }
        $(this).files = dt_multi.files;

        $(`span.file-delete_${type_file}`).click(function () {

            let name = $(this).next("span.name").text();

            $(this).parent().parent().remove();

            for (let i = 0; i < dt_multi.items.length; i++) {
                if (name === dt_multi.items[i].getAsFile().name) {

                    dt_multi.items.remove(i);
                    continue;
                }
            }
            document.getElementById(`${type_file}`).files = dt_multi.files;
            $('#add_image_cover').show();
        });
    }
});
