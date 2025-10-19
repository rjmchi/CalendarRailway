<script setup lang="ts">
import Label from './ui/label/Label.vue';
import InputError from './InputError.vue';
import Input from './ui/input/Input.vue';
import Button from './ui/button/Button.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { Event } from '@/types';
import { ref, watch } from 'vue';
import { index, store, update, destroy } from '@/routes/bookings';

interface Props {
    event: Event,
}

const props = defineProps<Props>();
const isEditing = ref(false);

const form = useForm({
    start: props.event.start.split(' ')[0],
    end: props.event.end.split(' ')[0],
    title: props.event.title,
})

const submit = () => {

    if (isEditing.value) {
        form.submit(update(props.event.id),
            { onSuccess: () => form.reset() })
    } else {

        form.submit(store(),
            { onSuccess: () => form.reset() })
    }
    isEditing.value = false;
}

watch(() => props.event, (event) => {
    form.start = event.start.split(' ')[0];
    form.end = event.end.split(' ')[0];
    form.title = event.title;
    isEditing.value = true;
})
</script>

<template>

    <div class="border border-teal-500 rounded p-2">
        <form @submit.prevent="submit" class="p-6 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <Label for="start_date">Start Date</Label>
                    <Input id="start_date" type="date" v-model="form.start"
                        :class="{ 'border-red-500': form.errors.start }" />
                    <InputError :message="form.errors.start" />
                </div>

                <div>
                    <Label for="end_date">End Date</Label>
                    <Input id="end_date" type="date" v-model="form.end"
                        :class="{ 'border-red-500': form.errors.end }" />
                    <InputError :message="form.errors.end" />
                </div>
            </div>

            <div>
                <Label for="guest_name">Guest Name</Label>
                <Input id="guest_name" type="text" v-model="form.title"
                    :class="{ 'border-red-500': form.errors.title }" />
                <InputError :message="form.errors.title" />
            </div>

            <div class="flex items-center gap-4">
                <div v-if="isEditing" class="flex gap-2">
                    <Button :disabled="form.processing">
                        Update
                    </Button>
                    <Link :href="destroy(event.id)">
                    <Button variant="destructive" :disabled="form.processing">
                        Delete
                    </Button>
                    </Link>
                </div>
                <div v-else>
                    <Button :disabled="form.processing">
                        Create Booking
                    </Button>
                </div>
                <Link :href="index()" class="text-gray-600 hover:text-gray-900">
                <Button variant="secondary">Cancel</Button>
                </Link>
            </div>
        </form>

    </div>

</template>
