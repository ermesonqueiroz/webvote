<script setup lang="ts">
import { Option } from "@/types";
import { router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const props = defineProps<{
    firstOption: Option;
    secondOption: Option;
}>();

const firstOptionVotesAmount = ref(props.firstOption.votes_amount)
const secondOptionVotesAmount = ref(props.secondOption.votes_amount)

function handleVote(option: Option) {
    router.patch(`/option/${option.id}`, {
        votes_amount: option.votes_amount + 1
    });
}

onMounted(() => {
    Object.values(props).forEach((option: Option) => {
        window.Echo.channel(`options.${option.id}`)
            .listen('VoteProcessed', (a) => {
                console.log(a)
            })

        console.log(window.Echo.channel(`options.${option.id}`).notification((a) => console.log(a)))
    });
});


</script>

<template>
    <div class="grid grid-cols-3 min-h-screen items-center max-w-screen-lg mx-auto">
        <div class="flex flex-col gap-3 items-center mx-auto w-fit">
            <p class="text-4xl font-bold text-indigo-600">{{ firstOptionVotesAmount }}</p>
            <h1 class="text-white text-2xl uppercase font-bold">{{ firstOption.description }}</h1>
            <button
                type="button"
                @click="handleVote(firstOption)"
                class="font-bold uppercase bg-indigo-600 w-full rounded-md py-1 hover:bg-indigo-500 text-gray-100"
            >
                Votar
            </button>
        </div>

        <h1 class="mx-auto text-7xl text-indigo-600 select-none">vs</h1>

        <div class="flex flex-col gap-3 items-center w-fit mx-auto">
            <p class="text-4xl font-bold text-indigo-600">{{ secondOptionVotesAmount }}</p>
            <h1 class="text-white text-2xl uppercase font-bold">{{ secondOption.description }}</h1>
            <button
                type="button"
                @click="handleVote(secondOption)"
                class="font-bold uppercase bg-indigo-600 w-full rounded-md py-1 hover:bg-indigo-500 text-gray-100"
            >
                Votar
            </button>
        </div>
    </div>
</template>
