<script setup>
import {Head} from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { computed } from 'vue';


const props = defineProps ({

    status:{
        type: Number,
        required: true,
    },
});


const title = computed(() => {
    return {
        404: "Page not found",
        403: "403 | Forbidden"
    }[props.status] || "An Error Occured";
})

const description = computed(() => {
    return {
        404: "The page you are looking for does not exist.",
        403: "You do not have permission to access this page."
        }[props.status] || "An error occurred while processing your request.";
})
</script>



<template>
    <Head :title="title" />
    <GuestLayout>
        <div class="mb-4 font-medium text-sm text-green-600">
           {{ description }}
        </div>
    </GuestLayout>
</template>
