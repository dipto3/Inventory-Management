document.addEventListener("DOMContentLoaded", function () {
    const productForm = document.getElementById("productForm");
    const regularImageInput = document.getElementById("productImages");
    const regularPreviewContainer = document.getElementById(
        "imagePreviewContainer"
    );
    const regularImage = document.getElementById("regularImage");
    const variantImage = document.getElementById("variantImage");
    const regularImageSection = document.getElementById("regularImageSection");
    const variantImageOptions = document.getElementById("variantImageOptions");

    // Initialize selectpicker
    $(".selectpicker").selectpicker({
        width: "80%",
        liveSearch: true,
        container: "body",
    });

    // Form submission handler with proper file upload
    productForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        try {
            const formData = new FormData(this);

            // Debug logging
            console.group("Form Submission Debug");
            console.log("Regular Images:", regularImageInput.files);
            console.log("Form Data Entries:");
            for (let pair of formData.entries()) {
                console.log(pair[0], ":", pair[1]);
            }
            console.groupEnd();

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';

            // Get CSRF token
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            // Submit the form using fetch
            const response = await fetch(this.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                credentials: "same-origin",
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || "Error updating product");
            }

            // Show success message
            Swal.fire({
                title: "Success!",
                text: "Product updated successfully",
                icon: "success",
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/products"; // Adjust the redirect URL as needed
                }
            });
        } catch (error) {
            console.error("Submission Error:", error);

            // Show error message
            Swal.fire({
                title: "Error!",
                text: error.message || "Failed to update product",
                icon: "error",
                confirmButtonText: "OK",
            });
        } finally {
            // Reset submit button
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Update Product";
        }
    });

    // Regular image upload handler
    regularImageInput.addEventListener("change", function (event) {
        console.log("Selected Files:", event.target.files);
        const files = event.target.files;

        // Validate files
        for (let file of files) {
            // Check file type
            if (!file.type.startsWith("image/")) {
                alert("Please upload only image files");
                this.value = "";
                return;
            }

            // Check file size (5MB limit)
            if (file.size > 5 * 1024 * 1024) {
                alert("File size should not exceed 5MB");
                this.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                const imgContainer = createImagePreviewElement(e.target.result);
                regularPreviewContainer.insertBefore(
                    imgContainer,
                    regularPreviewContainer.lastElementChild
                );
            };
            reader.readAsDataURL(file);
        }
    });

    // Create image preview element
    function createImagePreviewElement(imageSrc) {
        const container = document.createElement("div");
        container.classList.add(
            "border",
            "rounded",
            "p-2",
            "position-relative"
        );
        container.style.width = "100px";
        container.style.height = "100px";

        const img = document.createElement("img");
        img.src = imageSrc;
        img.classList.add("img-fluid", "h-100", "w-100");
        img.style.objectFit = "cover";

        const removeBtn = document.createElement("button");
        removeBtn.innerHTML = '<i class="bi bi-x"></i>';
        removeBtn.classList.add(
            "btn",
            "btn-sm",
            "btn-danger",
            "position-absolute",
            "top-0",
            "end-0",
            "p-0",
            "m-1"
        );
        removeBtn.style.width = "20px";
        removeBtn.style.height = "20px";
        removeBtn.onclick = (e) => {
            e.preventDefault();
            container.remove();
        };

        container.appendChild(img);
        container.appendChild(removeBtn);
        return container;
    }

    // Delete image handler
    window.deleteImage = async function (imageId, element) {
        try {
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const response = await fetch(`/admin/product-images/${imageId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                credentials: "same-origin",
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || "Error deleting image");
            }

            // Remove the image container from DOM
            element.closest(".border.rounded").remove();
        } catch (error) {
            console.error("Delete Error:", error);
            Swal.fire({
                title: "Error!",
                text: error.message || "Failed to delete image",
                icon: "error",
                confirmButtonText: "OK",
            });
        }
    };

    // Image section toggle handler
    function toggleImageSections() {
        regularImageSection.style.display = regularImage.checked
            ? "block"
            : "none";
        variantImageOptions.style.display = variantImage.checked
            ? "block"
            : "none";
    }

    regularImage.addEventListener("change", toggleImageSections);
    variantImage.addEventListener("change", toggleImageSections);
});
