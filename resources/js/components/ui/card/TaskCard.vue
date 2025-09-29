<template>
    <Link :href>
    <Card class="taskCard my-2 px-1">
        <CardHeader>
            <div class="flex justify-between items-center text-xs mb-4">
                <p>
                    {{ priority }}
                </p>
                <p class="text-ellipsis mask-ellipse rounded bg-orange-300 p-0.5">
                    {{ tag }}
                    <ActionOption />
                </p>
            </div>
            <CardTitle>{{ title }}</CardTitle>
            <CardDescription>
                {{ description }}
            </CardDescription>
        </CardHeader>
        <CardContent>
            <img class="rounded max-w-[15Opx]" :src="image" alt="Image illustration">
        </CardContent>
        <CardFooter class="grid">
            <div class="flex justify-between items-center">
                <p class="flex gap-0.5 text-xs items-center">
                    <Loader :size="13" />
                    <span class="text-zinc-400">
                        Progression
                    </span>
                </p>
                <p class="text-xs text-zinc-400">{{ progression }}%</p>
            </div>
            <Progress class="w-full mt-2" :model-value="progression" />
        </CardFooter>
    </Card>
    </Link>
</template>

<script setup lang="ts">
import { Progress } from '@/components/ui/progress';
import { Loader } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';


defineProps({
    priority: String,
    tag: String,
    title: String,
    description: String,
    image: String,
    progression: Number,
    href: String
})
</script>

<style scoped>
img {
    max-width: 140px;
    margin: 0 auto;
}

.taskCard {
    transition: all .5s ease;
    border: 1.5px dashed transparent;
    cursor: auto;
}

.taskCard:hover {
    border: 1.5px dashed #2b79ac;
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'><circle cx='16' cy='16' r='14' fill='%23262626'/></svg>") 8 8, auto;
}

</style>