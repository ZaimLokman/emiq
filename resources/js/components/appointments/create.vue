<script setup>
	import { onMounted, ref } from "vue"
	import { useRouter } from 'vue-router';

	let form = ref([])
	let allPatient = ref([])
	let patient_id = ref([])

	const router = useRouter();

	onMounted(async() => {
		indexForm()
		getAllPatient()
	})

	const indexForm = async() => {
		let response = await axios.get('/api/v1/appointment/create')
		// console.log('form', response.data)
		form.value = response.data
	}

	const getAllPatient = async() => {
		let response = await axios.get('/api/v1/appointment/patients')
		console.log('patients', response)
		allPatient.value = response.data.patients
	}

	const onSave = () => {
		// if(form.appt_code != null) {
			const formData = new FormData()
			formData.append('code', form.appt_code)
			formData.append('appt_datetime', form.date)
			formData.append('patient_id', patient_id.value)
			formData.append('created_at', form.value.created_at)
			formData.append('arrived_at', form.value.arrived_at)
			formData.append('status', form.value.status)

			axios.post("/api/v1/appointment/store", formData)
			// router.push('/')
			console.log('result', response)
		// }
	}
</script>

<template>
	<div class="container">
		<div class="appointments">
	        
	        <div class="card__header">
	            <div>
	                <h2 class="appointment__title">New Appointment</h2>
	            </div>
	            <div>
	                
	            </div>
	        </div>

	        <div class="card__content">
	            <div class="card__content--header">
	                <div>
	                    <p class="my-1">Patient</p>
	                    <select name="" id="" class="input" v-model="patient_id">
	                    	<option disabled>Select Patient</option>
	                        <option :value="patient.id" v-for="patient in allPatient" :key="patient.id">{{ patient.name }}</option>
	                    </select>
	                    <p class="my-1">Appointment Code</p> 
	                    <input type="text" class="input" v-model="form.appt_code">
	                    <p class="my-1">Date</p> 
	                    <input id="date" type="datetime-local" class="input" v-model="form.date">
	                </div>
	            </div>
	           
	        </div>
	        <div class="card__header" style="margin-top: 40px;">
	            <div>
	                
	            </div>
	            <div>
	                <a class="btn btn-secondary" @click="onSave()">
	                    Save
	                </a>
	            </div>
	        </div>
	        
	    </div>
	</div>
	
</template>