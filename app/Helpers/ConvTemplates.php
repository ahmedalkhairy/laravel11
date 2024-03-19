<?php

namespace App\Helpers;

class ConvTemplates
{
    public static $default_conversation;
    public static $conv_templates;

    public static function init()
    {
        self::$default_conversation = self::conv_llava_llama_2();
        self::$conv_templates = [
            "default" => self::conv_vicuna_v0(),
            "v0" => self::conv_vicuna_v0(),
            "v1" => self::conv_vicuna_v1(),
            "vicuna_v1" => self::conv_vicuna_v1(),
            "llama_2" => self::conv_llama_2(),

            "plain" => self::conv_llava_plain(),
            "v0_plain" => self::conv_llava_plain(),
            "llava_v0" => self::conv_llava_v0(),
            "v0_mmtag" => self::conv_llava_v0_mmtag(),
            "llava_v1" => self::conv_llava_v1(),
            "v1_mmtag" => self::conv_llava_v1_mmtag(),
            "llava_llama_2" => self::conv_llava_llama_2(),

            "mpt" => self::conv_mpt(),
        ];
    }

    public static function conv_vicuna_v0()
    {
        return new Conversation(
            "A chat between a curious human and an artificial intelligence assistant. "
            . "The assistant gives helpful, detailed, and polite answers to the human's questions.",
            ["Human", "Assistant"],
            [
                ["Human", "What are the key differences between renewable and non-renewable energy sources?"],
                ["Assistant",
                    "Renewable energy sources are those that can be replenished naturally in a relatively "
                    . "short amount of time, such as solar, wind, hydro, geothermal, and biomass. "
                    . "Non-renewable energy sources, on the other hand, are finite and will eventually be "
                    . "depleted, such as coal, oil, and natural gas. Here are some key differences between "
                    . "renewable and non-renewable energy sources:\n"
                    . "1. Availability: Renewable energy sources are virtually inexhaustible, while non-renewable "
                    . "energy sources are finite and will eventually run out.\n"
                    . "2. Environmental impact: Renewable energy sources have a much lower environmental impact "
                    . "than non-renewable sources, which can lead to air and water pollution, greenhouse gas emissions, "
                    . "and other negative effects.\n"
                    . "3. Cost: Renewable energy sources can be more expensive to initially set up, but they typically "
                    . "have lower operational costs than non-renewable sources.\n"
                    . "4. Reliability: Renewable energy sources are often more reliable and can be used in more remote "
                    . "locations than non-renewable sources.\n"
                    . "5. Flexibility: Renewable energy sources are often more flexible and can be adapted to different "
                    . "situations and needs, while non-renewable sources are more rigid and inflexible.\n"
                    . "6. Sustainability: Renewable energy sources are more sustainable over the long term, while "
                    . "non-renewable sources are not, and their depletion can lead to economic and social instability.\n"
                ],
            ],
            2,
            SeparatorStyle::SINGLE,
            "###"
        );
    }

    public static function conv_vicuna_v1()
    {
        return new Conversation(
            "A chat between a curious user and an artificial intelligence assistant. "
            . "The assistant gives helpful, detailed, and polite answers to the user's questions.",
            ["USER", "ASSISTANT"],
            [],
            0,
            SeparatorStyle::TWO,
            " ",
            "</s>",
            "v1"
        );
    }

    public static function conv_llama_2()
    {
        return new Conversation(
            "You are a helpful, respectful and honest assistant. Always answer as helpfully as possible, while being safe.  Your answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content. Please ensure that your responses are socially unbiased and positive in nature.

If a question does not make any sense, or is not factually coherent, explain why instead of answering something not correct. If you don't know the answer to a question, please don't share false information.",
            ["USER", "ASSISTANT"],
            [],
            0,
            SeparatorStyle::LLAMA_2,
            "<s>",
            "</s>",
            "llama_v2"
        );
    }

    public static function conv_llava_llama_2()
    {
        return new Conversation(
            "You are a helpful language and vision assistant. "
            . "You are able to understand the visual content that the user provides, "
            . "and assist the user with a variety of tasks using natural language.",
            ["USER", "ASSISTANT"],
            [],
            0,
            SeparatorStyle::LLAMA_2,
            "<s>",
            "</s>",
            "llama_v2"
        );
    }

    public static function conv_mpt()
    {
        return new Conversation(
            "system\n"
            . "A conversation between a user and an LLM-based AI assistant. The assistant gives helpful and honest answers.",
            ["user\n", "assistant\n"],
            [],
            0,
            SeparatorStyle::MPT,
            ""
        );
    }

    public static function conv_llava_plain()
    {
        return new Conversation(
            "",
            ["", ""],
            [],
            0,
            SeparatorStyle::PLAIN,
            "\n"
        );
    }

    public static function conv_llava_v0()
    {
        return new Conversation(
            "A chat between a curious human and an artificial intelligence assistant. "
            . "The assistant gives helpful, detailed, and polite answers to the human's questions.",
            ["Human", "Assistant"],
            [],
            0,
            SeparatorStyle::SINGLE,
            "###"
        );
    }

    public static function conv_llava_v0_mmtag()
    {
        return new Conversation(
            "A chat between a curious user and an artificial intelligence assistant. "
            . "The assistant is able to understand the visual content that the user provides, and assist the user with a variety of tasks using natural language."
            . "The visual content will be provided with the following format: <Image>visual content</Image>.",
            ["Human", "Assistant"],
            [],
            0,
            SeparatorStyle::SINGLE,
            "###",
            "v0_mmtag"
        );
    }

    public static function conv_llava_v1()
    {
        return new Conversation(
            "A chat between a curious human and an artificial intelligence assistant. "
            . "The assistant gives helpful, detailed, and polite answers to the human's questions.",
            ["USER", "ASSISTANT"],
            [],
            0,
            SeparatorStyle::TWO,
            " ",
            "</s>",
            "v1"
        );
    }

    public static function conv_llava_v1_mmtag()
    {
        return new Conversation(
            "A chat between a curious user and an artificial intelligence assistant. "
            . "The assistant is able to understand the visual content that the user provides, and assist the user with a variety of tasks using natural language."
            . "The visual content will be provided with the following format: <Image>visual content</Image>.",
            ["USER", "ASSISTANT"],
            [],
            0,
            SeparatorStyle::TWO,
            " ",
            "</s>",
            "v1_mmtag"
        );
    }
}
