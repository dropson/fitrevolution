import { HSOverlay } from "flyonui/flyonui";

function showPreview(workoutId) {
    const modalElement = document.querySelector("#preview-workout-modal");
    const modal = new HSOverlay(modalElement, {
        closeOnOverlayClick: false // 
    });
    modal.open();

    modalElement.addEventListener('click', (event) => {
        if (event.target === modalElement) {
            event.stopPropagation();
            event.preventDefault();
        }
    });

    const closeButton = modalElement.querySelector('.preview-workout-modal-close');
    closeButton.addEventListener('click', () => {
        modal.close();
    });

    const url = `/fit/workouts/${workoutId}/preview`;

    fetch(url)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            const workoutTitle = document.querySelector("#workout-title");
            // const exerciseList = document.querySelector(".exercise-list");
            // exerciseList.innerHTML = "";
            workoutTitle.textContent = data.data.title;

            // data.data.exercises.forEach((exercise) => {
            //     const exerciseCard = document.createElement("div");
            //     exerciseCard.className = "card mb-4";
            //     exerciseCard.innerHTML = `
            //         <div class="card-body p-3">
            //             <div class="flex gap-3">
            //                 <div class="flex flex-col flex-grow">
            //                     <div class="flex justify-between items-center mb-3">
            //                         <h5 class="card-title text-base flex items-center">
            //                             ${exercise.title}
            //                             <span class="badge badge-outline badge-info badge-sm ml-3 text-xs">${
            //                                 exercise.muscle_group
            //                             }</span>
            //                         </h5>
            //                     </div>
            //                     <div class="reps-list">
            //                         ${exercise.sets
            //                             .map(
            //                                 (set) => `
            //                             <div class="flex gap-3 justify-end">
            //                                 <div class="flex items-center">
            //                                     <span class="font-bold text-xs mr-2">Sets</span>
            //                                     <input disabled value="${
            //                                         set.sets_number
            //                                     }" class="input input-sm w-14 text-center font-bold text-black">
            //                                 </div>
            //                                 <div class="flex items-center">
            //                                     <span class="font-bold text-xs mr-2">Reps</span>
            //                                     <input disabled value="${
            //                                         set.repetitions
            //                                     }" class="input input-sm w-14 text-center font-bold text-black">
            //                                 </div>
            //                                 <div class="flex items-center">
            //                                     <span class="font-bold text-xs mr-2">Weight (kg)</span>
            //                                     <input disabled value="${
            //                                         set.weight ?? ""
            //                                     }" class="input input-sm w-20 text-center font-bold text-black">
            //                                 </div>
            //                             </div>
            //                         `
            //                             )
            //                             .join("")}
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
            //     `;
            //     exerciseList.appendChild(exerciseCard);
            // });

            modal.on('close', () => {
                workoutTitle.textContent = "";
                // exerciseList.innerHTML = "";
            });
        })
        .catch((error) => {
            console.error("Error:", error);
            // const exerciseList = document.querySelector(".exercise-list");
            // exerciseList.innerHTML = `<p class="text-red-500">Data loading error: ${error.message}</p>`;
        });
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".preview-workout").forEach((button) => {
        button.addEventListener("click", function () {
            const workoutId = this.getAttribute("data-workout");
            showPreview(workoutId);
        });
    });
});