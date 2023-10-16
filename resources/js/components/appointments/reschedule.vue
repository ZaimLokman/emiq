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
		let response = await axios.get('/api/v1/appointment/reschedule')
		// console.log('form', response.data)
		form.value = response.data
	}

	const onReschedule = () => {
		// if(form.appt_code != null) {
			const formData = new FormData()
			formData.append('code', form.value.appt_code)
			formData.append('appt_datetime', form.date)
			formData.append('patient_id', form.value.patient_id)
			formData.append('created_at', form.value.created_at)
			formData.append('arrived_at', form.value.arrived_at)
			formData.append('status', form.value.status)

			axios.post("/api/v1/appointment/update", formData)
			router.push('/')
		// }
	}
</script>

<template>
	<div class="container">
		<div class="appointments">
	        
	        <div class="card__header">
	            <div>
	                <h2 class="appointment__title">Rescheduling</h2>
	            </div>
	            <div>
	                
	            </div>
	        </div>

	        <div class="card__content">
	            <div class="card__content--header">
	                <div>
	                    <p class="my-1">Reschedule Date</p> 
	                    <input id="date" type="datetime-local" class="input" v-model="form.date">
	                </div>
	            </div>
	           
	        </div>
	        <div class="card__header" style="margin-top: 40px;">
	            <div>
	                
	            </div>
	            <div>
	                <a class="btn btn-secondary" @click="onReschedule()">
	                    Reschedule
	                </a>
	            </div>
	        </div>
	        
	    </div>
	</div>
	
</template>