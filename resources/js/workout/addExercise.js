document.addEventListener("DOMContentLoaded", () => {
    let exerciseIndex = document.querySelectorAll(".exercise-list .card").length;

    // Функція для перерахунку індексів
    const reindexExercises = () => {
        const exerciseList = document.querySelector(".exercise-list");
        const exerciseCards = exerciseList.querySelectorAll(".card.mb-4");
        exerciseCards.forEach((card, index) => {
            const inputs = card.querySelectorAll("input");
            inputs.forEach((input) => {
                const name = input.getAttribute("name");
                if (name) {
                    const newName = name.replace(/exercises\[\d+\]/, `exercises[${index}]`);
                    input.setAttribute("name", newName);
                }
            });
        });
        exerciseIndex = exerciseCards.length;
    };

    // Додаємо обробник для видалення вправ через делегування подій
    const exerciseList = document.querySelector(".exercise-list");
    exerciseList.addEventListener("click", (event) => {
        if (event.target.closest(".remove-exercise")) {
            const exerciseCard = event.target.closest(".card.mb-4");
            if (exerciseCard) {
                // Якщо вправа з бази даних, позначаємо її як видалену
                const deletedInput = exerciseCard.querySelector(".exercise-deleted");
                if (deletedInput) {
                    deletedInput.value = "1"; // Позначаємо як видалену
                    exerciseCard.style.display = "none"; // Ховаємо картку
                } else {
                    // Якщо вправа додана через JS, просто видаляємо її
                    exerciseCard.remove();
                }
                reindexExercises(); // Перераховуємо індекси
            }
        }
    });

    // Обробник для додавання нових вправ
    document.querySelectorAll("[data-exercise]").forEach((button) => {
        button.addEventListener("click", function () {
            const exerciseId = this.getAttribute("data-exercise");
            const exerciseItem = this.closest(".exercise-item");
            const title = exerciseItem.querySelector("h4").textContent.trim();
            const muscleGroup = exerciseItem.querySelector("span").childNodes[0].textContent.trim();

            // // Перевіряємо, чи вправа вже додана
            // const existingExercise = exerciseList.querySelector(`input[name*="[id]"][value="${exerciseId}"]`);
            // if (existingExercise) {
            //     alert("This exercise is already added!");
            //     return;
            // }

            // Створюємо нову вправу
            const exerciseCard = document.createElement("div");
            exerciseCard.className = "card mb-4";
            exerciseCard.innerHTML = `
                <div class="card-body p-3">
                    <div class="flex gap-3">
                        <span class="icon-[tabler--grid-dots] cursor-pointer p-2 mt-1.5"></span>
                        <div class="flex flex-col flex-grow">
                            <div class="flex justify-between items-center mb-3">
                                <input type="hidden" name="exercises[${exerciseIndex}][id]" value="${exerciseId}">
                                <input type="hidden" name="exercises[${exerciseIndex}][deleted]" value="0" class="exercise-deleted">
                                <h5 class="card-title text-base flex items-center">
                                    ${title}
                                    <span class="badge badge-outline badge-info badge-sm ml-3 text-xs">${muscleGroup}</span>
                                </h5>
                                <button type="button" class="remove-exercise">
                                    <span class="icon-[tabler--trash] size-4"></span>
                                </button>
                            </div>
                            <div class="reps-list">
                                <div class="flex gap-5 justify-end me-10">
                                    <div class="flex items-center">
                                        <span class="font-bold text-sm mr-2">Sets</span>
                                        <input type="text" name="exercises[${exerciseIndex}][sets][0][sets_number]" value="4" class="input input-sm w-14 text-center font-bold text-black" />
                                    </div>
                                    <div class="flex items-center">
                                        <span class="font-bold text-sm mr-2">Reps</span>
                                        <input type="text" name="exercises[${exerciseIndex}][sets][0][repetitions]" value="10" class="input input-sm w-14 text-center font-bold text-black" />
                                    </div>
                                    <div class="flex items-center">
                                        <span class="font-bold text-sm mr-2">Weight (kg)</span>
                                        <input type="text" name="exercises[${exerciseIndex}][sets][0][weight]" value="0" class="input input-sm w-20 text-center font-bold text-black" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            exerciseList.appendChild(exerciseCard);
            exerciseIndex++;
        });
    });
});