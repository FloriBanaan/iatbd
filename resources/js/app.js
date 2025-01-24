import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function() {
    var modals = document.querySelectorAll(".modal");
    var openModalBtns = document.querySelectorAll(".openModalBtn");
    var closeModalBtns = document.querySelectorAll(".close");
    var sendMessageBtns = document.querySelectorAll(".sendMessageBtn");

    openModalBtns.forEach(function(btn) {
        btn.onclick = function() {
            var modal = this.closest(".huisdier").querySelector(".modal");
            modal.style.display = "block";
        }
    });

    closeModalBtns.forEach(function(btn) {
        btn.onclick = function() {
            var modal = this.closest(".modal");
            modal.style.display = "none";
        }
    });

    window.onclick = function(event) {
        modals.forEach(function(modal) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    };

    sendMessageBtns.forEach(function(btn) {
        btn.onclick = function() {
            var message = this.closest(".modal").querySelector(".message").value;
            var huisdierId = this.closest(".huisdier").dataset.huisdierId;
        };
    });
});