<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppHeader from '@/components/AppHeader.vue';
import Calendar from '@/components/Calendar.vue';
import { Booking } from '@/types';

interface Props {
    bookings: Booking[]
}

//use the interface
defineProps<Props>();

</script>

<template>

    <Head title="Admin" />
    <AppHeader />

    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
        <Calendar :bookings="bookings" :editable=true />
    </div>
</template>
