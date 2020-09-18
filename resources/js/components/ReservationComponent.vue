<template>
    <div>
        <button class="btn bg-info">Edit</button>
    </div>
</template>

<script>
    export default {
        props: [
            'reservation'
        ],
        name    : "ReservationComponent",
        data() {
            return {
                showModal: false
            }
        }

    }
</script>
