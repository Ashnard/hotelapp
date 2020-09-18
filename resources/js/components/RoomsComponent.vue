<template>
    <div class="card-body">
        <form method="POST" @submit.prevent="checkVacancy">
            <input type="hidden" name="_token" v-bind:value="csrf">
            <div class="form-group row">
                <label for="check_in" class="col-md-4 col-form-label text-md-right">Check-in time</label>

                <div class="col-md-6">
                    <input :min="mindate" max="2030-01-01"
                           type="date" class="form-control"
                           name="check_in"
                           required :autocomplete="mindate" autofocus
                           v-model="fields.check_in"
                    >
                </div>
            </div>
            <div class="form-group row">
                <label for="check_out" class="col-md-4 col-form-label text-md-right">Check-out time</label>

                <div class="col-md-6">
                    <input :min="mindateout" max="2030-01-01"
                           type="date" class="form-control"
                           name="check_out"
                           required :autocomplete="mindateout"
                           v-model="fields.check_out">

                </div>
            </div>
            <div class="form-group row">
                <label for="bed_qty" class="col-md-4 col-form-label text-md-right">Beds</label>

                <div class="col-md-6">
                    <input min="1" max="10"
                           type="number" class="form-control"
                           name="bed_qty" value="1"
                           required autocomplete="1"
                           v-model="fields.bed_qty">
                </div>
            </div>
            <div class="form-group row">
                <label for="budget" class="col-md-4 col-form-label text-md-right">Budget</label>

                <div class="col-md-6">
                    <input min="0.00" max="50000"
                           type="number" class="form-control"
                           name="budget" value="0.00" step="0.01"
                           required autocomplete="0.00"
                           v-model="fields.budget">
                </div>
            </div>
            <div class="form-group row mb-0 ">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Check Vacancy
                    </button>
                </div>
            </div>
        </form>
        <div v-if="groups" v-for="(group, index) in groups"  class="card mt-2">
            <div class="card-header">Option #{{index+1}}
                <button class="btn btn-outline-primary float-right" @click="reservationForm(group)">Select</button>
            </div>
            <div class="card-body p-2">
                <ul>
                    <li v-for="room in group">{{ room.name }} (#{{room.room_num}})</li>
                </ul>
            </div>
        </div>
        <div v-if="group" class="card mt-2">
            <div class="card-header">Register your information</div>
            <div class="card-body">
                <form method="POST" @submit.prevent="registerReservation">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <div class="form-group row mt-2">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" maxlength="50"
                                   name="email"
                                   required autofocus
                                   v-model="reservation.email"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" maxlength="50"
                                   name="first_name"
                                   required
                                   v-model="reservation.first_name"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" maxlength="50"
                                   name="last_name"
                                   required
                                   v-model="reservation.last_name"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                        <div class="col-md-6">
                            <input type="tel" class="form-control" name="phone" pattern="[0-9]{6,15}"
                                   required placeholder="1234546748"
                                   v-model="reservation.phone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_in" class="col-md-4 col-form-label text-md-right">Check-in date</label>

                        <div class="col-md-6">
                            <input :min="mindate" max="2030-01-01"
                                   type="date" class="form-control"
                                   name="check_in"
                                   required readonly
                                   v-model="reservation.check_in"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_out" class="col-md-4 col-form-label text-md-right">Check-out date</label>

                        <div class="col-md-6">
                            <input :min="mindateout" max="2030-01-01"
                                   type="date" class="form-control"
                                   name="check_out"
                                   required readonly
                                   v-model="reservation.check_out">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bed_qty" class="col-md-4 col-form-label text-md-right">Beds</label>

                        <div class="col-md-6">
                            <input min="1" max="10"
                                   type="number" class="form-control"
                                   name="bed_qty"
                                   required readonly
                                   v-model="reservation.bed_qty">
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <p class="col-md-4 col-form-label text-md-right">Rooms</p>
                        <ul>
                            <li v-for="room in group">{{ room.name }} (#{{room.room_num}})</li>
                        </ul>
                    </div>
                    <div class="form-group row mb-1 ">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Reserve
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'csrf',
            'mindate',
            'mindateout'
        ],
        data() {
            return {
                fields : {
                    check_in: this.$props.mindate,
                    check_out: this.$props.mindateout,
                    bed_qty: 1,
                    budget: "0.00",
                },
                reservation: {},
                groups : null,
                group : null
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            checkVacancy(){
                axios.post('/vacancy', this.fields).then(response => {
                    this.groups = response.data;
                    this.group = null;
                    if (response.data == '') {
                        alert('No rooms found for this criteria');
                    }
                }).catch(error => {
                    console.log('error');
                });
            },
            reservationForm(group) {
                this.group = group;
                this.reservation.check_in = this.fields.check_in;
                this.reservation.check_out = this.fields.check_out;
                this.reservation.bed_qty = this.fields.bed_qty;
                this.groups = null;
            },
            registerReservation() {
                axios.post('/reservation/create', {group: this.group, reservation: this.reservation}).then(response => {
                    this.group = null;
                    if (response.data == '' || response.data == 'failed') {
                        alert('There\'s been an issue, try again');
                    } else {
                        alert('Reservation done!')
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
