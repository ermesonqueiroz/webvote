<script setup lang="ts">
import { ref, onMounted, watchEffect } from "vue";
import { websocket } from "@/services/websocket";
import type { Option } from "@/types";

const selectedOptionId = ref<number | null>(null);
const selectedOption = ref<Option | null>(null);
const options = ref<Option[]>([]);

function updateOption(data: Option) {
  options.value = options.value.map((option) => data.id === option.id ? data : option);
}

function selectOption(id: number) {
  if (selectedOptionId.value != id) selectedOptionId.value = id
  else selectedOptionId.value = null;
}

async function incrementVotesAmount(data: Option) {
  const updatedData: Option = {
    ...data,
    votes_amount: data.votes_amount + 1
  };

  updateOption(updatedData);
  await fetch(`${import.meta.env.VITE_API_BASE_URL}/options/${data.id}`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ votes_amount: updatedData.votes_amount })  
  });
}

onMounted(async () => {
  const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/options`);
  options.value = await response.json() as Option[];

  options.value.forEach(({ id }) => {
    websocket
      .subscribe(`options.${id}`)
      .bind('vote.processed', (data: Option) => updateOption(data));
  });
});

watchEffect( () => {
  if (selectedOptionId && options.value.length > 0)
    selectedOption.value = options.value.find(({ id }) => id == selectedOptionId.value!) ?? null;
});
</script>

<template>
  <div class="flex flex-col mx-auto items-center max-w-screen-md my-14">
    <h1 class="text-2xl font-bold">Qual o melhor time?</h1>

    <ul class="w-full grid grid-cols-2 mt-14 gap-5">
      <li
        v-for="option in options"
        :class="`px-5 py-4 rounded-xl flex items-center justify-between border border-neutral-800 hover:border-neutral-600 hover:bg-neutral-700 cursor-pointer ${selectedOption?.id === option.id ? 'bg-neutral-700' : 'bg-neutral-800'}`"
        @click="selectOption(option.id)"
      >
        <div>
          <h1 class="text-2xl font-bold">{{ option.title }}</h1>
          <p>{{ option.description }}</p>
        </div>

        <p class="text-2xl font-bold text-indigo-500">{{ option.votes_amount }}</p>
      </li>
    </ul>
  </div>

  <button
    @click="incrementVotesAmount(selectedOption!)"
    :disabled="!selectedOption"
    :class="`absolute w-full max-w-screen-md text-xl left-1/2 -translate-x-1/2 bottom-14 h-14 rounded-md font-bold uppercase ${selectedOption?.id ? 'bg-indigo-600 text-white' : 'bg-neutral-800 text-neutral-400'}`"
  >
    Votar
  </button>
</template>
