<template>
    <Card class="my-2 px-1">
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
            <img class="rounded"
                :src="image"
                alt="Image illustration">
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
</template>

<script setup lang="ts">
import { Progress } from '@/components/ui/progress';
import {Loader } from 'lucide-vue-next';

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
    progression: Number
})
</script>