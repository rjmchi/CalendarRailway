<script setup lang="ts">
import Calendar from '@/components/Calendar.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Booking } from '@/types';
import { login } from '@/routes';
import Button from '@/components/ui/button/Button.vue';

interface Props {
    bookings: Booking[]
}

//use the interface
defineProps<Props>();


</script>

<template>

    <Head title="Guest" />

    <div>
        <Calendar :bookings="bookings" />


        <div class="m-10">
            <Link :href="login()"><Button variant="secondary">Login</Button></Link>
        </div>
    </div>

</template>
