#!/bin/bash

# Detect the highest supported x86-64 micro-architecture level.
# Function: get_cpu_arch_level -> sets global var CPU_LEVEL to one of: v1|v2|v3|v4
# Notes:
# - Efficiency: read flags once, hash-set membership checks, early exit per level.
# - Minimum output policy: if v1 not satisfied, still set CPU_LEVEL="v1".

get_cpu_arch_level() {
    # Read flags once and build a set
    local flags_line
    flags_line=$(awk -F: '/^flags/{print $2; exit}' /proc/cpuinfo)

    local -A has
    local f
    for f in $flags_line; do
        has[$f]=1
    done

    # Required flags per level
    local -a v1=(lm cmov cx8 fpu fxsr mmx syscall sse2)
    local -a v2=(cx16 lahf popcnt sse4_1 sse4_2 ssse3)
    local -a v3=(avx avx2 bmi1 bmi2 f16c fma abm movbe xsave)
    local -a v4=(avx512f avx512bw avx512cd avx512dq avx512vl)

    # Helper: all flags of a level present?
    local level_ok
    level_ok() {
        local -n req=$1
        local r
        for r in "${req[@]}"; do
            [[ ${has[$r]+y} ]] || return 1
        done
        return 0
    }

    local supported=0

    if level_ok v1; then
        supported=1
    else
        CPU_LEVEL="v1"; return 0
    fi

    if level_ok v2; then
        supported=2
    else
        CPU_LEVEL="v${supported}"; return 0
    fi

    if level_ok v3; then
        supported=3
    else
        CPU_LEVEL="v${supported}"; return 0
    fi

    if level_ok v4; then
        supported=4
    fi

    CPU_LEVEL="v${supported}"
}


get_cpu_arch_level
echo "$CPU_LEVEL"
