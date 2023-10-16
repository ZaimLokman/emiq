<script setup>
	import { onMounted, ref } from "vue"
	import { useRouter } from "vue-router"

	const router = useRouter()

	let appointments = ref([])
	let searchAppointments = ref([])

	onMounted(async()=> {
		getAppointments()
	})

	const getAppointments = async() => {
		let response = await axios.get("/api/v1/appointment/list")
		// console.log('response', response)
		appointments.value = response.data.appointments
	}

	const newAppointment = async() => {
		let form = await axios.get("/api/v1/appointment/create")
		// console.log('response', form.data)
		router.push('/appointment/create')
	}

	const onReschedule = () => {
		router.push('/api/v1/appointment/reschedule/'+id)
	}

	const onArrived = (id) => {
		router.push('/api/v1/appointment/arrived/'+id)
	}
</script>

<template>
	<div class="container">
		<div class="invoices">
		        
	        <div class="card__header">
	            <div>
	                <h2 class="invoice__title">Appointments</h2>
	            </div>
	            <div>
	                <a class="btn btn-secondary" @click="newAppointment">
	                    New Appointment
	                </a>
	            </div>
	        </div>

	        <div class="table card__content">
	            <div class="table--filter">
	                <span class="table--filter--collapseBtn ">
	                    <i class="fas fa-ellipsis-h"></i>
	                </span>
	                <div class="table--filter--listWrapper">
	                    <ul class="table--filter--list">
	                        <li>
	                            <p class="table--filter--link table--filter--link--active">
	                                All
	                            </p>
	                        </li>
	                        <li>
	                            <p class="table--filter--link ">
	                                Paid
	                            </p>
	                        </li>
	                    </ul>
	                </div>
	            </div>

	            <div class="table--search">
	                <div class="table--search--wrapper">
	                    <select class="table--search--select" name="" id="">
	                        <option value="">Filter</option>
	                    </select>
	                </div>
	                <div class="relative">
	                    <i class="table--search--input--icon fas fa-search "></i>
	                    <input class="table--search--input" type="text" placeholder="Search invoice">
	                </div>
	            </div>

	            <div class="table--heading">
	                <p>ID</p>
	                <p>Appt Code</p>
	                <p>Appt Date</p>
	                <p>Patient ID</p>
	                <p>Time Create</p>
	                <p>Time Arrived</p>
	                <p>Status</p>
	                <p>Action</p>
	            </div>

	            <!-- item 1 -->
	            <div class="table--items" v-for="item in appointments" :key="item.id" v-if="appointments.length > 0">
	                <p>{{ item.id }}</p>
	                <p>{{ item.code }}</p>
	                <p>{{ item.appt_datetime }}</p>
	                <p v-if="item.patient">
		                {{ item.patient.name }}
		            </p>
		            <p v-else></p>
	                <p>{{ item.created_at }}</p>
	                <p>{{ item.arrived_at }}</p>
	                <p>{{ item.status }}</p>
	                <p>
	                	<a @click="onArrived(item.id)" title="Arrived">
		                    ☑️
		                </a>
	                	<a @click="reschedule" title="Reschedule">
		                    🗓️
		                </a>
	                </p>
	            </div>
	            <div class="table--items" v-else>
	            	<p>There are no data</p>	            	
	            </div>
	        </div>
	        
	    </div>

	    <br><br><br>
	</div>
</template>