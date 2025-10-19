<script setup lang="ts">
import { computed, ref } from 'vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import EventForm from '@/components/EventForm.vue';
import { Booking, Event } from '@/types';

interface SelectArg {
    start: string,
    end: string,
    startStr: string,
    endStr: string,
}

interface EventArg {
    event: Event,
}

interface Props {
    bookings: Booking[],
    editable?: boolean,
}
const event = ref<Event>({
    start: '',
    end: '',
    id: 0,
    title: ''
});

const props = defineProps<Props>();

const calendarOptions: any = computed(() => ({
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'today'
    },
    events: props.bookings,
    height: 'auto',
    eventDisplay: 'block',
    eventColor: props.editable ? 'teal' : 'red',
    editable: props.editable ? true : false,
    selectable: props.editable ? true : false,
    select: props.editable ? handleDateSelect : null,
    eventClick: props.editable ? showEvent : null,

}));


const showEvent = (arg: EventArg) => {

    event.value = calendarOptions.value.events.find(
        (eventarg: Event) => eventarg.id === +arg.event.id
    );

    console.log(event.value);
}

const handleDateSelect = (arg: SelectArg) => {
    // event.value.start = arg.startStr;
    // event.value.end = arg.endStr;
    console.log(arg.endStr)
}

</script>

<template>
    <div class="border border-teal-500 rounded p-2">
        <FullCalendar :options="calendarOptions" />
        <EventForm v-show="editable" :event="event" />
    </div>
</template>