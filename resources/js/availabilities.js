let availabilityIndex = document.querySelectorAll('.availability-card').length;
let availabilities = document.getElementById('availabilities');
const weekdays = [
    { value: 'monday', label: 'Segunda-feira' },
    { value: 'tuesday', label: 'Terça-feira' },
    { value: 'wednesday', label: 'Quarta-feira' },
    { value: 'thursday', label: 'Quinta-feira' },
    { value: 'friday', label: 'Sexta-feira' },
    { value: 'saturday', label: 'Sábado' },
    { value: 'sunday', label: 'Domingo' }
];

document.getElementById("add-availability").addEventListener("click", (e) => {
    e.preventDefault();

    let content = `
    <div class="availability-card message is-info mt-3">
        <div class="message-header">
            <p style="color: white">Disponibilidade</p>
            <button class="delete" aria-label="delete"></button>
        </div>
        <div class="message-body" style="background: rgb(217 217 217)">
            <div class="control">
                <label class="label">Dias da semana:</label>
                <div class="field checkboxes mb-3">
                    ${weekdays.map(day => `
                        <label class="checkbox">
                            <input type="checkbox" name="availabilities[${availabilityIndex}][weekdays][]" value="${day.value}" />
                            ${day.label}
                        </label>
                    `).join(' ')}
                </div>
            </div>

            <div class="is-flex">
                <div class="control has-icons-left has-icons-right mr-4">
                    <label class="label">Abre:</label>
                    <input class="input" type="time" name="availabilities[${availabilityIndex}][open_time]" />
                </div>
                <div class="control has-icons-left has-icons-right">
                    <label class="label">Fecha:</label>
                    <input class="input" type="time" name="availabilities[${availabilityIndex}][close_time]" />
                </div>
            </div>
        </div>
    </div>
    `;

    availabilities.insertAdjacentHTML('beforeend', content);

    const lastCard = availabilities.querySelector('.availability-card:last-child');
    const deleteBtn = lastCard.querySelector('.delete');

    deleteBtn.addEventListener('click', (e) => {
        lastCard.remove();
    });

    availabilityIndex++;
});

// Apaga as janelas de disponibilidade já cadastradas.
document.querySelectorAll('.availability-card .delete').forEach(element => {
    element.addEventListener('click', (e) => {
        e.preventDefault();
        element.closest('.availability-card').remove();
    });
});